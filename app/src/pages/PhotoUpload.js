import React from "react"

export const PhotoUpload = () => {
	return (
		<>
			<div className="container">
<form>
	<h4>To Upload Photo for sign drag and drop files below</h4>
	<div style={{ width: 660, height: 450 }}>
		<div className="App" id="drop-zone">
			<h5>Just drag and drop files here</h5>

		</div>
	</div>


	<div class="progress">
		<div className="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" >
			<span className="sr-only">60% Complete</span>
		</div>
	</div>
	<div class="js-upload-finished">
		<h3>Processed files</h3>
		<div className="list-group">
			<a href="#" className="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-01.jpg</a>
			<a href="#" className="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-02.jpg</a>
		</div>
	</div>
	<div style={{ width: 660, height:50 }}>
	</div>
	<div className="input-group" id="mainApp">
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
	<div style={{ width: 660, height:50 }}>
	</div>
	<div className="autocomplete">
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



