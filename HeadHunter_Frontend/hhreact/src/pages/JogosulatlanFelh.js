import React from "react";
import "../styles/info.css";
import VisszaLink from "../components/menu/VisszaLink";

export default function JogosulatlanFelh(){
  return (
      <div className="container">
        <h1>Sajnos nincs megfelelő jogosultságod!</h1>
        <VisszaLink />
      </div>
  );
};