import React from 'react';
import { Link } from 'react-router-dom';



const MenuKartya = (props) => {
  return (
   
      <Link className="maincard" to={props.link}>
        <img src={props.picture} alt={props.title} />
        <h3 className="maincard-title">{props.title}</h3>
      </Link>
 
  );
};

export default MenuKartya;
