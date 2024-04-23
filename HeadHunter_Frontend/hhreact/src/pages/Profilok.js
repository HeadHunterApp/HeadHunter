
import useAuthContext from "../contexts/AuthContext";
import FejvadaszProfil from "../components/FejvadaszProfil";
import AllaskeresoProfil from "../components/AllaskeresoProfil"; 

export default function Profilok(){
    const { user} = useAuthContext();
    return(
        <div>
          {/*    {user.jogosultsag === "admin" && <AdminProfil/>} */} 
            {user.jogosultsag === "fejvadász" && <FejvadaszProfil/>}
            {user.jogosultsag === "álláskereső" && <AllaskeresoProfil/>} 
        </div>
    )
}