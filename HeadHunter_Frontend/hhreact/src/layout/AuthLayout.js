import React from "react";
import { Outlet, Navigate } from "react-router-dom";
import useAuthContext from "../contexts/AuthContext";
import Footer from "../components/Footer";
import Header from "../components/Header";

//jogosulatlan felhasználó page-et még meg kell írni

export default function AuthLayout({jogosultFelh}) {
    const { user} = useAuthContext();
    const hasJogosultsag = user?.jogosultsag?.some((jogosultsag) => jogosultFelh.includes(jogosultsag));

  return (
    <>
      <Header />
      {hasJogosultsag ? (
        <Outlet />
      ) : (
        <Navigate to="/unauthorized" replace />
      )}
      <Footer />
    </>
  );
}

