import React from 'react';
import ImageUploader from 'react-images-upload';

export const ImageUploader= ()=> {
		render()
	{
			return (
				<ImagesUploader
					url="http://localhost:9090/notmultiple"
					optimisticPreviews
					multiple={false}
					onLoadEnd={(err) => {
						if (err) {
							console.error(err);
						}
					}}
					label="Upload a picture"
				/>
			);
		}
	};