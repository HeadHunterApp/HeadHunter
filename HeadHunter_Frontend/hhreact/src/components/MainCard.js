import React from 'react';

const MainCard = (props) => {
  return (
    <div className="maincard">
      <img src={props.picture} alt={props.title} />
      <h3 className="maincard-title">{props.title}</h3>
    </div>
  );
};

export default MainCard;
