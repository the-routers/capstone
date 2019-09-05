import React, {useCallback} from 'react'
import {useDropzone} from 'react-dropzone'

export const MyDropzone =() => {
	const onDrop = useCallback(acceptedFiles => {
		// Do something with the files
	}, []);
	const {getRootProps, getInputProps, isDragActive} = useDropzone({onDrop});

	let black;
	return (
		<div {...getRootProps()}>
			<input {...getInputProps()} style={{ width: 850, height:400 }}/>
			{
				isDragActive ?
					<p>Drop the files here ...</p> :
					<p>Drag 'n' drop some files here, or click to select files</p>
			}
		</div>
	)
};