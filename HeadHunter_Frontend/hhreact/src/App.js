import React from "react";
import { Route, Routes } from "react-router-dom";
//import Main from "./components/Main";
import "./styles/App.css";
//layoutok:
import VendegLayout from "./layout/VendegLayout";
import AuthLayout from "./layout/AuthLayout";
//oldalak:
import Fooldal from "./pages/Fooldal";
import Kezdolap from "./pages/Kezdolap";
import Profilok from "./pages/Profilok";
import Allaskereses from "./pages/AllasKereses";
//a többi page-et még létre kell hozni


export default function App() {
  return (
    <Routes>

      <Route path="/" element={<VendegLayout />}>
        {/*belépés nélkül is elérhető */}
        <Route index element={<Fooldal />} />
        <Route path="jobs" element={<Allaskereses />} />
        
        {/* jövőbeli route-ok:
        
        <Route path="seeker-info" element={<AllaskerInfo />} />
        <Route path="employer-info" element={<MunkaltatoInfo />} />
        <Route path="contact" element={<Kapcsolat />} />
        <Route path="unauthorized" element={<JogosulatlanFelh />} />

        */}
      </Route>

      <Route path="/" element={<AuthLayout jogosultFelh={[]} />}>
        {/*minden belépett felhasználó */}
        <Route index element={<Kezdolap />} />
        <Route path="profile" element={<Profilok />} />
      </Route>

      <Route path="seeker" element={<AuthLayout jogosultFelh={['álláskereső']} />}>
        {/*elvileg nincs olyan route, amit csak ő érne el */}
      </Route>

      <Route path="hunter" element={<AuthLayout jogosultFelh={['fejvadász']} />}>
        {/* jövőbeli route-ok:
        
        <Route path="jobseekers" element={<Allaskeresok />} />
        <Route path="queries" element={<Lekerdezesek />} />

        */}
      </Route>

      <Route path="admin" element={<AuthLayout jogosultFelh={['admin']} />}>
        {/* jövőbeli route-ok:
        
        <Route path="jobseekers" element={<Allaskeresok />} />
        <Route path="headhunters" element={<Fejvadaszok />} />
        <Route path="queries" element={<Lekerdezesek />} />
        <Route path="employers" element={<Munkaltatok />} />
        <Route path="fields" element={<Teruletek />} />
        <Route path="positions" element={<Poziciok />} />
        <Route path="languages" element={<Nyelvtudas />} />
        <Route path="skills" element={<Kepessegek />} />

        */}
        
      </Route>

    </Routes>
  );
}
