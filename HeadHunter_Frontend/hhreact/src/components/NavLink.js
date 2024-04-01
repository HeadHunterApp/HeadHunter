import React from "react";
import { Link } from "react-router-dom";

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