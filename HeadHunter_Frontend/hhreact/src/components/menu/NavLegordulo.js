import React from "react";
import { useNavigate } from "react-router-dom";
import Dropdown from 'react-dropdown';


export default function NavLegordulo() {
    const navigate = useNavigate();

    const legorduloLista = [
        { label: "Területek", value: "/fields" },
        { label: "Pozíciók", value: "/positions" },
        { label: "Képességek", value: "/skills" },
        { label: "Nyelvtudás", value: "/languages" }
    ];
    const menuNev = "Továbbiak ⮟";

    const valasztasKezeles = (valasztott) => {
      if (valasztott.value === "/positions") {
        navigate(`/admin${valasztott.value}`); // Itt navigálunk a /positions útvonalra
    } else {
        navigate(valasztott.value);
    }
    };


  return (
    <Dropdown controlClassName="Dropdown"
    optionClassName="Dropdown-option"
    options={legorduloLista}
    onChange={valasztasKezeles}
    value={menuNev}
    placeholder="Továbbiak" />
  );
};
