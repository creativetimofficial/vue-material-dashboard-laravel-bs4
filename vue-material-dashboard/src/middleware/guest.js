import store from "../store";

export default function guest({ next, router }) {
  if (store.getters.isAuthenticated) {
    return router.push({ name: "Home" });
  }

  return next();
}
