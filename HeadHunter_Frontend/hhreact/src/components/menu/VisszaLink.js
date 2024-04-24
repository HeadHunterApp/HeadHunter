import { Link } from "react-router-dom";
import "../../styles/vissza.css";

const VisszaLink = () => {
  return (
    <div className="back">
      <h3>
        <Link to="#" onClick={() => window.history.back()}>
        Vissza az előző oldalra
        </Link>
      </h3>
    </div>
  );
};

export default VisszaLink;