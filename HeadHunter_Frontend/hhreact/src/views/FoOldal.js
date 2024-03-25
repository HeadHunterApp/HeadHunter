import React from "react";
import Header from "../components/Header";
import Footer from "../components/Footer";
import RightSide from "../components/RightSide";
import LeftSide from "../components/LeftSide";
import "../styles/Fooldal.css";
/* import '../styles/Admin_allasok.css'; */
import Regisztral from "../components/RegisztralForm";
const Fooldal = () => {
  return (
    <div>
      <Header />
      <main>
        <RightSide />
      
        <LeftSide />
      </main>
      <Footer />
    </div>
  );
};

export default Fooldal;
