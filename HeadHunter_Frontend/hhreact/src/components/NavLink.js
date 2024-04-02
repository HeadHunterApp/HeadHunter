import React from "react";
import { Link } from "react-router-dom";
import "../styles/components/Navigation.css";

const NavLink = (props) => {
  return (
    <li>
      <Link className="navLink" to={props.link}>
        {props.title}
      </Link>
    </li>
  );
};

export default NavLink;