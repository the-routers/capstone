import React from "react";
import {httpConfig} from "../../../utils/http-config";


export const ImageUploader = () => {
	const uploadSignImage = (imagefile) => {
		httpConfig.post("/apis/userPhoto/", imagefile)
			.then(reply => {
					let {message, type} = reply;
				//	setStatus({message, type});
					console.log(message);
					if(reply.status === 200) {
				//		setStatus({message, type});
						console.log(message);
					}
				}
			);
	};

	const queueSignImage=(imagefile) =>{
console.log(imagefile);
		// add signimage to state

	};
	return (

		<>
			<h4>Upload your sign photos</h4>
			<div>
				<input type="file" id="signImage" accept=".jpg, .jpeg, .svg, .png"
						 onChange={(e) => {
							 queueSignImage(e.target.files[0]);
							 uploadSignImage(e.target.files[0]);
						 }}
						 onClick={(event) => {
							 event.target.value = null
						 }}
				/>
			</div>
		</>
	)
};