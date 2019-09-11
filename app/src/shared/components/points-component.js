import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {Marker} from "react-mapbox-gl";
import React, {useState} from "react";
import Modal from "react-bootstrap/Modal";
import Button from "react-bootstrap/Button";
import Layer from "react-mapbox-gl/lib-esm/layer";



export const  PointsComponent = ({sign}) => {

	const [show, setShow] = useState(false);
	const handleClose = () => setShow(false);
	const handleShow = () => setShow(true);
	console.log(sign);
		return (

				<Marker className="marker-color"
					key={sign.signId}
					coordinates={{lat: sign.signLat, lng: sign.signLong}}
					anchor="bottom"
					>
					<FontAwesomeIcon icon="map-marker-alt" size="2x" onClick={handleShow}/>
					<Modal show={show} onHide={handleClose}>
						<Modal.Header closeButton>
							<Modal.Title>{sign.signName}</Modal.Title>
						</Modal.Header>
						<Modal.Body>{sign.signDescription}</Modal.Body>
						<Modal.Footer>
							<Button variant="secondary" onClick={handleClose}>
								Close
							</Button>
						</Modal.Footer>
					</Modal>


				</Marker>

		)
};
