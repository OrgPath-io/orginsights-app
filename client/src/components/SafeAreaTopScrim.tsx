// Safe area top scrim for mobile notches.
// Replaces the SDK's SafeAreaTopScrim component.

export function SafeAreaTopScrim({ backgroundColor }: { backgroundColor?: string }) {
  return (
    <div
      aria-hidden
      style={{
        position: "sticky",
        top: 0,
        height: "env(safe-area-inset-top, 0px)",
        backgroundColor: backgroundColor ?? "transparent",
        zIndex: 50,
        pointerEvents: "none",
      }}
    />
  );
}
