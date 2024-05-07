import React from "react";
import { Route, Routes } from "react-router-dom";
import "./styles/App.css";
import useAuthContext from "./contexts/AuthContext";
import VendegLayout from "./layout/VendegLayout";
import AuthLayout from "./layout/AuthLayout";
import Kezdolap from "./pages/Kezdolap";
import Profilok from "./pages/Profilok";
import Allaskereses from "./pages/AllasKereses";
import AllasAdatlap from "./pages/AllasAdatlap";
import AllaskerInfo from "./pages/informacio/AllaskerInfo";
import MunkaltatoInfo from "./pages/informacio/MunkaltatoInfo";
import Kapcsolat from "./pages/informacio/Kapcsolat";
import JogosulatlanFelh from "./pages/JogosulatlanFelh";
import MunkaltatokLista from "./components/admin/MunkaltatokLista";

import Allaskeresok from "./components/felhasznalo-kezeles/profil/components/Allaskeresok";
import AllaskeresoAdatlap from "./components/felhasznalo-kezeles/profil/AllaskeresoAdatlap";
import Allasok from "./components/admin/Allasok";
import Poziciok from "./components/admin/Poziciok";


export default function App() {
  const { user } = useAuthContext();
  const belepve = !!user;

  return (
    <Routes>
      <Route
        path="/"
        element={
          belepve ? <AuthLayout jogosultFelh={[user.jogosultsag]} /> : <VendegLayout /> 
        }
      >
        <Route index element={<Kezdolap />} />
        <Route path="jobs" element={<Allaskereses />} />
        <Route path="job-info/:allas_id" element={<AllasAdatlap />} />
        <Route path="seeker-info/:user_id" element={<AllaskeresoAdatlap />} />
        <Route path="seeker-info" element={<AllaskerInfo />} />
        <Route path="employer-info" element={<MunkaltatoInfo />} />
        <Route path="contact" element={<Kapcsolat />} />
      

        {belepve && (
          <>
            <Route path="profile" element={<Profilok />} />

            <Route
              path="seeker">
              {/* Jövőbeli route a saját jelentkezéseinek megtekintéséhez:
              <Route path="my-applications" element={<JelentkezesSajat />} />
              */}
            </Route>

            <Route
              path="hunter">
              <Route path="employers" element={<MunkaltatokLista />} />
              <Route path="jobseekers" element={<Allaskeresok />} />
              <Route path="jobs" element={<Allasok />} />
              {/* Jövőbeli route-ok:
              
              <Route path="applicants" element={<Jelentkezok />} />
              <Route path="hired" element={<FelvettJelentkezok />} />
              */}
            </Route>

            <Route
              path="admin">
              <Route path="employers" element={<MunkaltatokLista />} />
              <Route path="jobseekers" element={<Allaskeresok />} />
              <Route path="jobs" element={<Allasok />} />
              <Route path="positions" element={<Poziciok />} />

              {/* Jövőbeli route-ok:*/
              /*<Route path="applicants" element={<Jelentkezok />} />
              <Route path="hired" element={<FelvettJelentkezok />} />
                 <Route path="headhunters" element={<Fejvadaszok />} />
              <Route path="fields" element={<Teruletek />} />
              <Route path="positions" element={<Poziciok />} />
              <Route path="languages" element={<Nyelvtudas />} />
              <Route path="skills" element={<Kepessegek />} />
              */}
              
            </Route>
          </>
        )}
      </Route>
      <Route path="unauthorized" element={<JogosulatlanFelh />} />
    </Routes>
  );
}
