import { createServer } from "miragejs";

//data
import main from "@/server/data/main.json";

export function startServer() {
  return createServer({
    routes() {
  
      this.get("/api/", () => {
        return main;
      })

    }
  })
}