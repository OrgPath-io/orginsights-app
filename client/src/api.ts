// Typed RPC client for standalone deployment.
//
// Replaces @hatch/space-sdk/client's createActionClient.
// POSTs {action, args} to /api/actions and returns the typed response.
//
// `import type { Actions }` is type-only by design: the client bundle never
// pulls in any server runtime. The Actions type comes from server/src/actions.ts
// which only exports types to the client (all runtime imports are type-stripped).

import type { Actions } from "../../server/src/actions";

// Extract request/response types from action definitions
export type ApiRequest<A extends { request: { _type: unknown } }> = A["request"] extends { _type: infer T } ? T : never;
export type ApiResponse<A extends { response: { _type: unknown } }> = A["response"] extends { _type: infer T } ? T : never;

type ActionName = keyof typeof Actions & string;

class ApiError extends Error {
  status: number;
  constructor(message: string, status: number) {
    super(message);
    this.name = "ApiError";
    this.status = status;
  }
}

async function callAction(name: string, args: unknown): Promise<unknown> {
  const res = await fetch("/api/actions", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ action: name, args: args ?? {} }),
  });

  if (!res.ok) {
    let message = `Action "${name}" failed (${res.status})`;
    try {
      const body = await res.json();
      if (body?.message) message = body.message;
    } catch {
      // Use default message
    }
    throw new ApiError(message, res.status);
  }

  return res.json();
}

// Proxy-based typed client: api.actionName(args) -> Promise<response>
// Matches the ergonomics of the SDK's createActionClient.
export const api = new Proxy({} as {
  [K in ActionName]: (
    args: import("zod").infer<(typeof Actions)[K]["request"]>
  ) => Promise<import("zod").infer<(typeof Actions)[K]["response"]>>;
}, {
  get: (_target, prop: string) => {
    return (args: unknown) => callAction(prop, args);
  },
});

export { ApiError };
