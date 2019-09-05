import React from "react"
import 'bootstrap/dist/css/bootstrap.css';
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {MyDropzone} from "../shared/components/main-nav/photoupload/MyDropzone";
import {backgroundPattern} from "mapbox-gl/src/shaders";
import {Footer} from "../shared/components/Footer";


export const PhotoUpload = () => {
	return (
		<form className="background-pattern-1 ">

		<div className="container text-center">
					<h4>To Upload Photo for sign drag and drop files below</h4>
					<div style={{ width: 660, height:20 }}>
					</div>
					<div className="border border-dark bg-light ">
							<MyDropzone/>
					</div>
		</div>
			<div style={{ width: 660, height:20 }}>
			</div>
s
<div className="container text-center">
	<div className="input-group" style={{height:80 }}>
		<div className="input-group-prepend">
			<span className="input-group-text">PhotoCaption</span>
		</div>
		<textarea className="form-control" aria-label="With textarea"/>
	</div>
</div>
			<div style={{ width: 660, height:30 }}>
			</div>
<div className="container">
	<div className="input-group" id="mainApp" >
				<div className="custom-file">
			<input
				type="file"
				className="custom-file-input"
				id="inputGroupFile01"
				aria-describedby="inputGroupFileAddon01"
			/>
			<label className="custom-file-label text-left" htmlFor="inputGroupFile01">
				Choose file
			</label>
		</div>
	</div>
</div>
	<div style={{ width: 660, height:20 }}>
	</div>
<div className="container">
	<div className="autocomplete text-left" style={{ width: 700, height:80 }}>
		<input id="mySigns" type="text" name="mySign" placeholder="Enter sign"/>
			<input type="submit"/>
		<div style={{ width: 660, height:20 }}>
			</div>
		<button type="submit" className="btn btn-light">UploadImage</button>


	</div>
<Footer/>
</div>
		</form>

	)
};



