import React from "react"
import 'bootstrap/dist/css/bootstrap.css';
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {useDropzone} from 'react-dropzone'



export const PhotoUpload = () => {
	return (
		<>
			<div className="container text-center">
				<form>
					<h4>To Upload Photo for sign drag and drop files below</h4>
		<div style={{ width: 660, height: 400 }}>
		<div className="App" id="drop-zone">
			<h5>Just drag and drop files here</h5>
		</div>
			<FontAwesomeIcon icon="faCloudUploadAlt"/>
				</div>
				</form>
			</div>
<div className="container text-center">
	<form>
	<div class="progress" style={{ width: 850, height:20 }}>
		<div className="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" >
			<span className="sr-only">60% Complete</span>
		</div>
	</div>
	<div class="js-upload-finished">
		<h5>Processed files</h5>
		{/*<div className="list-group">*/}
		{/*	<a href="#" className="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-01.jpg</a>*/}
		{/*	<a href="#" className="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-02.jpg</a>*/}
		{/*</div>*/}
	</div>
	<div style={{ width: 660, height:50 }}>
	</div>
	<div className="input-group" style={{ width: 850, height:120 }}>
		<div className="input-group-prepend">
			<span className="input-group-text">PhotoCaption</span>
		</div>
		<textarea className="form-control" aria-label="With textarea"/>
	</div>
	<div style={{ width: 660, height:50 }}>
	</div>
	<div className="input-group" id="mainApp" style={{ width: 850, height:80 }}>
				<div className="custom-file">
			<input
				type="file"
				className="custom-file-input"
				id="inputGroupFile01"
				aria-describedby="inputGroupFileAddon01"
			/>
			<label className="custom-file-label" htmlFor="inputGroupFile01">
				Choose file
			</label>
		</div>
	</div>
	<div style={{ width: 660, height:20 }}>
	</div>
	<div className="autocomplete" style={{ width: 660, height:50 }}>
		<input id="mySigns" type="text" name="mySign" placeholder="Enter sign"/>
			<input type="submit"/>
	</div>
	<div  style={{ width: 660, height:20 }}>
	</div>
	<button type="submit" className="btn btn-primary">UploadImage</button>
		</form>
		</div>

</>
	)
};



