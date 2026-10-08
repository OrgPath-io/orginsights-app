/**
 * Compatibility shim replacing @hatch/space-sdk for standalone deployment.
 *
 * Provides the same interfaces the app code uses:
 * - defineAction({request, response, handler})
 * - z (zod)
 * - Ctx with db(), executePrivileged(), invalidateQueries(), blobs
 * - ActionsModule type
 *
 * The app's business logic in server/src/actions.ts is UNCHANGED.
 * Only the import lines were modified to use this shim.
 */

import { z } from "zod";
import type { BunSQLiteDatabase } from "drizzle-orm/bun-sqlite";

export { z };

// Database type matches what the app expects from ctx.db()
export type SpaceDb<TSchema extends Record<string, unknown> = Record<string, never>> =
  Pick<BunSQLiteDatabase<TSchema>, "select" | "insert" | "update" | "delete" | "run" | "all" | "get" | "batch">;

export type SpaceDbAccessor = <TSchema extends Record<string, unknown> = Record<string, never>>() => SpaceDb<TSchema>;

// Blob storage interface (question images, etc.)
export interface BlobClient {
  put(key: string, data: Uint8Array, opts?: { contentType?: string }): Promise<void>;
  getUrl(key: string): Promise<string | null>;
  get(key: string): Promise<Uint8Array | null>;
  delete(key: string): Promise<void>;
}

// Privileged operation contracts (PDF rendering, SMTP)
export interface PrivilegedContract {
  request: z.ZodType;
  response: z.ZodType;
  timeoutMs?: number;
}

export type PrivilegedExecutor = {
  executePrivileged<C extends PrivilegedContract>(
    contract: C,
    args: z.infer<C["request"]>
  ): Promise<z.infer<C["response"]>>;
};

// Full context passed to action handlers
export interface Ctx extends PrivilegedExecutor {
  readonly slug: string;
  readonly invocationId: string;
  readonly db: SpaceDbAccessor;
  readonly blobs: BlobClient;
  invalidateQueries(): void;
}

// Action definition (matches SDK's branded shape)
export const ACTION_BRAND = "@hatch/space-sdk/action/v1" as const;

export interface ActionDefinition<
  TCtx extends Ctx = Ctx,
  Req extends z.ZodType = z.ZodType,
  Res extends z.ZodType = z.ZodType
> {
  readonly __brand: typeof ACTION_BRAND;
  readonly request: Req;
  readonly response: Res;
  readonly privileged?: readonly PrivilegedContract[];
  readonly handler: (ctx: TCtx, args: z.infer<Req>) => Promise<z.infer<Res>>;
}

export type ActionFactoryInput<
  TCtx extends Ctx,
  Req extends z.ZodType,
  Res extends z.ZodType
> = {
  request: Req;
  response: Res;
  privileged?: readonly PrivilegedContract[];
  handler: (ctx: TCtx, args: z.infer<Req>) => Promise<z.infer<Res>>;
};

export function defineAction<Req extends z.ZodType, Res extends z.ZodType>(
  spec: ActionFactoryInput<Ctx, Req, Res>
): ActionDefinition<Ctx, Req, Res> {
  return {
    __brand: ACTION_BRAND,
    request: spec.request,
    response: spec.response,
    privileged: spec.privileged,
    handler: spec.handler,
  };
}

export function isAction(value: unknown): value is ActionDefinition {
  return (
    typeof value === "object" &&
    value !== null &&
    (value as { __brand?: unknown }).__brand === ACTION_BRAND
  );
}

export type ActionsModule = Record<string, ActionDefinition>;

// Privileged contract helpers (replaces definePrivilegedContracts/definePrivilegedHandlers)
export function definePrivilegedContracts<const Specs extends Record<string, { request: z.ZodType; response: z.ZodType; timeoutMs?: number }>>(
  specs: Specs
): { [K in keyof Specs]: Specs[K] & { __contractName: K } } {
  const result: Record<string, unknown> = {};
  for (const [name, spec] of Object.entries(specs)) {
    result[name] = { ...spec, __contractName: name };
  }
  return result as { [K in keyof Specs]: Specs[K] & { __contractName: K } };
}

export type PrivilegedHandlers = {
  execute<C extends PrivilegedContract>(
    contract: C,
    args: z.infer<C["request"]>
  ): Promise<z.infer<C["response"]>>;
};

export function definePrivilegedHandlers<const Contracts extends Record<string, PrivilegedContract>>(
  contracts: Contracts,
  handlers: { [K in keyof Contracts]?: (args: z.infer<Contracts[K]["request"]>) => Promise<z.infer<Contracts[K]["response"]>> }
): PrivilegedHandlers & { __contracts: Contracts } {
  return {
    __contracts: contracts,
    async execute(contract: PrivilegedContract, args: unknown) {
      const name = (contract as { __contractName?: string }).__contractName;
      if (!name || !handlers[name as keyof Contracts]) {
        throw new Error(`No handler registered for privileged contract: ${String(name)}`);
      }
      const handler = handlers[name as keyof Contracts]!;
      return handler(args as never);
    },
  } as PrivilegedHandlers & { __contracts: Contracts };
}
