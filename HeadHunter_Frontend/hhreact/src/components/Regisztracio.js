import { useState } from "react";
import axios from "../api/axios";

const Regisztracio = () => {
  const [selectedNem, setNem] = useState("");
  const [email, setEmail] = useState("");

  const onSubmitHandler = (e) => {
    e.preventDefault();

    if (!email.includes("@")) {
      alert("");
      return;
    }

    axios.post("/regisztracio", {
      email,
      selectedNem,
    });
  };
  return (
    <form onSubmit={onSubmitHandler}>
      <label>
        <input
          type="radio"
          value="ferfi"
          checked={selectedNem === "ferfi"}
          onChange={(e) => setNem(e.target.value)}
        />
        Férfi
      </label>

      <label>
        <input
          type="radio"
          value="nő"
          checked={selectedNem === "nő"}
          onChange={(e) => setNem(e.target.value)}
        />
        Nő
      </label>

      <input type="email" onChange={(e) => setEmail(e.target.value)} />
      <button type="submit">Submit</button>
    </form>
  );
};

export default Regisztracio;
