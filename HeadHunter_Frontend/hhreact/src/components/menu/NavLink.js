import React from "react";
import { Link } from "react-router-dom";



const NavLink = (props) => {
  return (
    <li className="navlink">
      <Link to={props.link}>
        {props.title}
      </Link>
    </li>
  );
};

export default NavLink;