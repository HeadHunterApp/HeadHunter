import AdminProfil from "../components/felhasznalo-kezeles/profil/AdminProfil";
import useAuthContext from "../contexts/AuthContext";
import FejvadaszProfil from "../components/felhasznalo-kezeles/profil/FejvadaszProfil";
import AllaskeresoProfil from "../components/felhasznalo-kezeles/profil/AllaskeresoProfil"; 

//adminnak nem kell profil, szerintem törölni kéne

export default function Profilok(){
    const { user} = useAuthContext();
    return(
        <div>
             {user.jogosultsag === "admin" && <AdminProfil/>}
            {user.jogosultsag === "fejvadász" && <FejvadaszProfil/>}
            {user.jogosultsag === "álláskereső" && <AllaskeresoProfil/>} 
        </div>
    )
}