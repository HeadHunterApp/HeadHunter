import React from "react";
import { useNavigate } from "react-router-dom";
import Dropdown from 'react-dropdown';
import 'react-dropdown/style.css'; // importáljuk a default stílust

export default function NavLegordulo() {
    const navigate = useNavigate();

    const legorduloLista = [
        { label: "Területek", value: "/fields" },
        { label: "Pozíciók", value: "/positions" },
        { label: "Képességek", value: "/skills" },
        { label: "Nyelvtudás", value: "/languages" }
    ];
    const menuNev = "Továbbiak";

    const valasztasKezeles = (valasztott) => {
        navigate(valasztott.value);
    };

  return (
    <Dropdown
      className="nav-legordulo" // hozzáadott osztály
      controlClassName="Dropdown-control"
      menuClassName="Dropdown-menu teal-bg" // új osztály a háttérszínhez
      optionClassName="Dropdown-option"
      options={legorduloLista}
      onChange={valasztasKezeles}
      value={menuNev}
      placeholder="Továbbiak"
    />
  );
};
