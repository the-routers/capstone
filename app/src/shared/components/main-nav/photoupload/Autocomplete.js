import React from "react";
import {Typeahead} from "react-bootstrap-typeahead";

export const Autocomplete =({signs}) => {
const options=signs.map(sign=>sign.signName);
	//console.log(options);
			return (
				<>
					<Typeahead
						labelKey="name"
						placeholder="Enter sign name..."
						options={options}
						onChange={(e) => console.log(e)}
					/>
				</>
			);

	};
