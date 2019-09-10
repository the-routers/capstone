import React from "react";
import {Header} from "../shared/components/header";
import {Footer} from "../shared/components/Footer";
import clib from "../images/clib.jpeg";
import Kimo from "../images/Kimo.jpg";
import Nob2 from "../images/Nob2.jpg";
import wall from "../images/wall.jpg";
import Nobhill1 from "../images/Nobhill1.jpg";
import Lindy from "../images/Lindy.jpg";
import doghouse from "../images/doghouse.jpg";
import intersection from "../images/intersection.jpg";
import garcia from "../images/garcia.jpg";
import Premiere_Motel from "../images/Premiere_Motel.jpg";
import coffeeshop from "../images/coffee shop.jpeg";
import elvado from "../images/elvado.png";
import lodge from "../images/lodge.jpeg"
import elcamino from "../images/elcamino.jpg";


export const Gallery =() => {
	return (
		<>
			<Header/>

			<form className="background-pattern-1">
				<div className="container">
					<h2>Gallery</h2>
					<div className="container">
						<div  className="row">
							<div class="box mt-2 ml-2 pl-1 p-2 mr-2">
								<div class="boxInner">
									<img style={{ width: 320, height:320 }} src={Premiere_Motel}/>
									<div class="titleBox">Premiere-Motek</div>
								</div>
							</div>

							<div class="box mt-2 ml-2 pl-1 p-2 mr-2">
								<div class="boxInner">
									<img style={{ width: 320, height:320 }} src={Kimo} />
									<div class="titleBox">Kimo Theater</div>
								</div>
							</div>

							<div class="box mt-2 ml-2 pl-1 p-2 mr-2">
								<div class="boxInner">
									<img style={{ width: 320, height:320 }} src={Nob2} />
									<div class="titleBox">Nob Hill Court</div>
								</div>
							</div>

						</div>

						<div className="row">
							<div class="box mt-2 ml-2 pl-1 p-2 mr-2">
								<div class="boxInner">
									<img style={{ width: 320, height:320 }} src={elcamino}/>
									<div class="titleBox">El Camino Motel</div>
								</div>
							</div>

							<div class="box mt-2 ml-2 pl-1 p-2 mr-2">
								<div class="boxInner">
									<img style={{ width: 320, height:320 }} src={lodge} />
									<div class="titleBox">Luna Loge</div>
								</div>
							</div>

							<div class="box mt-2 ml-2 pl-1 p-2 mr-2">
								<div class="boxInner">
									<img style={{ width: 320, height:320 }} src={wall} />
									<div class="titleBox">Wall</div>
								</div>
							</div>
						</div>

						<div className="row">
							<div class="box mt-2 ml-2 pl-1 p-2 mr-2">
								<div class="boxInner">
									<img style={{ width: 320, height:320 }} src={elvado} />
									<div class="titleBox">El Vado Motel</div>
								</div>
							</div>
							<div class="box mt-2 ml-2 pl-1 p-2 mr-2">
								<div class="boxInner">
									<img style={{ width: 320, height:320 }} src={Lindy} />
									<div class="titleBox">Lindy Dinner</div>
								</div>
							</div>
							<div class="box mt-2 ml-2 pl-1 p-2 mr-2">
								<div class="boxInner">
									<img style={{ width: 320, height:320 }} src={coffeeshop} />
									<div class="titleBox">Coffee Shop</div>
								</div>
							</div>
						</div>

						<div className="row">
							<div class="box mt-2 ml-2 pl-1 p-2 mr-2">
								<div class="boxInner">
									<img style={{ width: 320, height:320 }} src={intersection} />
									<div class="titleBox">Intersection</div>
								</div>
							</div>
							<div className="box mt-2 ml-2 pl-1 p-2 mr-2">
								<div className="boxInner">
									<img style={{width: 320, height: 320}}
										  src={garcia}/>
									<div>Garcia's Cafes</div>
								</div>
							</div>
							<div className="box mt-2 ml-2 pl-1 p-2 mr-2">
								<div className="boxInner">
									<img style={{width: 320, height: 320}}
										  src={doghouse}/>
									<div className="titleBox">DogHouse</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div className="container">
					<Footer />
				</div>
			</form>
		</>
	)
}