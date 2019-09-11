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
						<div className="row">
							<div className="box col-lg-4 col-sm-6 col-xs-8">
								<div className="boxInner">
									<img style={{ width: 320, height:320 }} src={Premiere_Motel}  className="img-fluid"/>
									<div className="titleBox">Premiere-Motek</div>
								</div>
							</div>

							<div className="box col-lg-4 col-sm-6 col-xs-8">
								<div className="boxInner">
									<img style={{ width: 320, height:320 }} src={Kimo} className="img-fluid" />
									<div className="titleBox">Kimo Theater</div>
								</div>
							</div>

							<div className="box col-lg-4 col-sm-6 col-xs-8">
								<div className="boxInner">
									<img style={{ width: 320, height:320 }} src={Nob2} className="img-fluid" />
									<div className="titleBox">Nob Hill Court</div>
								</div>
							</div>
						</div>

						<div className="row">
							<div className="box col-lg-4 col-sm-6 col-xs-8">
								<div className="boxInner">
									<img style={{ width: 320, height:320 }} src={elcamino}  className="img-fluid"/>
									<div className="titleBox">El Camino Motel</div>
								</div>
							</div>

							<div className="box col-lg-4 col-sm-6 col-xs-8">
								<div className="boxInner">
									<img style={{ width: 320, height:320 }} src={lodge} className="img-fluid"/>
									<div className="titleBox">Luna Loge</div>
								</div>
							</div>

							<div className="box col-lg-4 col-sm-6 col-xs-8">
								<div className="boxInner">
									<img style={{ width: 320, height:320 }} src={wall} className="img-fluid"/>
									<div className="titleBox">Wall</div>
								</div>
							</div>
						</div>

						<div className="row">
							<div className="box col-lg-4 col-sm-6 col-xs-8">
								<div className="boxInner">
									<img style={{ width: 320, height:320 }} src={elvado} className="img-fluid"/>
									<div className="titleBox">El Vado Motel</div>
								</div>
							</div>
							<div className="box col-lg-4 col-sm-6 col-xs-8">
								<div className="boxInner">
									<img style={{ width: 320, height:320 }} src={Lindy} className="img-fluid" />
									<div className="titleBox">Lindy Dinner</div>
								</div>
							</div>
							<div className="box col-lg-4 col-sm-6 col-xs-8">
								<div className="boxInner">
									<img style={{ width: 320, height:320 }} src={coffeeshop} className="img-fluid" />
									<div className="titleBox">Coffee Shop</div>
								</div>
							</div>
						</div>

						<div className="row">
							<div className="box col-lg-4 col-sm-6 col-xs-8">
								<div className="boxInner">
									<img style={{ width: 320, height:320 }} src={intersection} className="img-fluid" />
									<div className="titleBox">Intersection</div>
								</div>
							</div>
							<div className="box col-lg-4 col-sm-6 col-xs-8">
								<div className="boxInner">
									<img style={{width: 320, height: 320}}
										  src={garcia} className="img-fluid"/>
									<div className="titleBox">Garcia's Cafe</div>
								</div>
							</div>
							<div className="box col-lg-4 col-sm-6 col-xs-8">
								<div className="boxInner">
									<img style={{width: 320, height: 320}}
										  className="img-fluid" src={doghouse}/>
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
};