import { Link, useNavigate } from "react-router-dom";
import "../../styles/vissza.css";

const VisszaLink = () => {
  const navigate = useNavigate();

  const visszaLepes = () => {
    navigate(-1);
  };
  
  return (
    <div className="back">
      <h3>
        <Link to="#" onClick={visszaLepes}>
        Vissza az előző oldalra
        </Link>
      </h3>
    </div>
  );
};

export default VisszaLink;