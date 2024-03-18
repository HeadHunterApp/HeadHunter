import React from "react";
import Header from "./components/Header";
import Footer from "./components/Footer";
import RightSide from "./RightSide";
import LeftSide from "./LeftSide";
import ".styles/Fooldal.css";
import '.styles/Admin_allasok.css';

const Fo_oldal = () => {
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

export default Fo_oldal;
