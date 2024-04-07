import { createPortal } from "react-dom";
import '../../../styles/FelhasznaloModal.css';
const CustomModal = (props) => {
  return createPortal(
    <>
      {props.isOpen && (
        <div className="modal">
          <div className="modal-content">
            <button className="close" onClick={props.onClose}>
              X
            </button>
            {props.children}
          </div>
        </div>
      )}
    </>,
    document.body
  );
};

export default CustomModal;
