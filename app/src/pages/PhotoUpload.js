import React from "react"

export const PhotoUpload = () => {
	return (
		<>
<form>
	<div className="input-group">
		<div className="input-group-prepend">
    <span className="input-group-text" id="inputGroupFileAddon01">
      Upload
    </span>
		</div>
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

	<div className="autocomplete" style="width:300px;">
		<input id="mysigns" type="text" name="mysign" placeholder="Enter sign"/>
			<input type="submit"/>
	</div>

</form>
		</>
	)
};



