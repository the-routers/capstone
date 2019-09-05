import React from "react";
import {Footer} from "../shared/components/Footer";

export const Gallery =() => {
	return (
		<>
			<form className="background-pattern-1">
			<div className="container">
			{/*	header section with logo and navbar*/}
			</div>
			<div className="container">
				<h2>Gallery</h2>
				<div className="container">
					<div  className="row">
					<div class="box">
						<div class="boxInner col-2">
							<img style={{ width: 320, height:320 }} src="http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/images/demo/7.jpg" />
							<div class="titleBox">Butterfly</div>
						</div>
					</div>

					<div class="box">
						<div class="boxInner col-2">
							<img style={{ width: 320, height:320 }} src="http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/images/demo/1.jpg" />
							<div class="titleBox">An old greenhouse</div>
						</div>
					</div>

					<div class="box">
						<div class="boxInner col-2">
							<img style={{ width: 320, height:320 }} src="http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/images/demo/2.jpg" />
							<div class="titleBox">Purple wildflowers</div>
						</div>
					</div>

					</div>

					<div className="row">
					<div class="box">
						<div class="boxInner col-2">
							<img style={{ width: 320, height:320 }} src="http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/images/demo/10.jpg" />
							<div class="titleBox">Crocus close-up</div>
						</div>
					</div>

					<div class="box">
						<div class="boxInner col-2">
							<img style={{ width: 320, height:320 }} src="http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/images/demo/5.jpg" />
							<div class="titleBox">Spring daffodils</div>
						</div>
					</div>

					<div class="box">
						<div class="boxInner col-2">
							<img style={{ width: 320, height:320 }} src="http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/images/demo/6.jpg" />
							<div class="titleBox">Iris along the path</div>
						</div>
					</div>
					</div>

					<div className="row">
					<div class="box">
						<div class="boxInner col-2">
							<img style={{ width: 320, height:320 }} src="http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/images/demo/8.jpg" />
							<div class="titleBox">The garden blueprint</div>
						</div>
					</div>
					<div class="box">
						<div class="boxInner col-2">
							<img style={{ width: 320, height:320 }} src="http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/images/demo/9.jpg" />
							<div class="titleBox">The patio</div>
						</div>
					</div>
					<div class="box">
						<div class="boxInner col-2">
							<img style={{ width: 320, height:320 }} src="http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/images/demo/11.jpg" />
							<div class="titleBox">Bumble bee collecting nectar</div>
						</div>
					</div>
					</div>

					<div className="row">
					<div class="box">
						<div class="boxInner col-2">
							<img style={{ width: 320, height:320 }} src="http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/images/demo/12.jpg" />
							<div class="titleBox">Winding garden path</div>
						</div>
					</div>
						<div className="box">
							<div className="boxInner col-2">
								<img style={{width: 320, height: 320}}
									  src="http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/images/demo/11.jpg"/>
								<div className="titleBox">Bumble bee collecting nectar</div>
							</div>
						</div>
						<div className="box">
							<div className="boxInner col-2">
								<img style={{width: 320, height: 320}}
									  src="http://www.dwuser.com/education/content/creating-responsive-tiled-layout-with-pure-css/images/demo/11.jpg"/>
								<div className="titleBox">Bumble bee collecting nectar</div>
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