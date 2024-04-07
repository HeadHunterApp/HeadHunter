import AdminProfil from "../components/AdminProfil";
import useAuthContext from "../contexts/AuthContext";
import FejvadaszProfil from "../components/FejvadaszProfil";
import AllaskeresoProfil from "../components/AllaskeresoProfil";

export default function Profilok(){
    const { user} = useAuthContext();
    return(
        <div>
        <FejvadaszProfil/>
{/*             {user.jogosultsagok === "admin" && <AdminProfil/>}
            {user.jogosultsagok === "fejvadász" && <FejvadaszProfil/>}
            {user.jogosultsagok === "álláskereső" && <AllaskeresoProfil/>} */}
        </div>
    )
}