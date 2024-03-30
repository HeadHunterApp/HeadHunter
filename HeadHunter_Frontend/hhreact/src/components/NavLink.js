import React from 'react';

const NavLink = (props) => {
  return (
        <li><a className='navLink' href={props.link}>{props.title}</a></li>
  );
};

export default NavLink;
