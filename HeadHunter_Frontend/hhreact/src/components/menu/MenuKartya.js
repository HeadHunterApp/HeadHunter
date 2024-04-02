import React from 'react';
import { Link } from 'react-router-dom';

const MenuKartya = (props) => {
  return (
    <div className="maincard">
      <Link to={props.link}>
        <img src={props.picture} alt={props.title} />
        <h3 className="maincard-title">{props.title}</h3>
      </Link>
    </div>
  );
};

export default MenuKartya;
