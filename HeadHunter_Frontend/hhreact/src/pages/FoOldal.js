import React from "react";
import "../styles/layouts/Fooldal.css";
import MainCard from "../components/MainCard";

const Fooldal = () => {
  return (
      <div className="maincard-container">
        <MainCard title='Álláskeresőknek' picture='/pics/fooldal/people-1979261_1280.jpg' />
        <MainCard title='Munkáltatóknak' picture='/pics/fooldal/laptop-3196481_1280.jpg' />
      </div>
  );
};

export default Fooldal;
