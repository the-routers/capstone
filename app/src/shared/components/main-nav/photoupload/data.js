import React from "react"

export function getStocks() {
	return [
		"La Puerta Motor Lodge",
		"Luna Lodge Motel",
		"Piñon Motel & Apartments",
		"Bow and Arrow Lodge",
		"Loma Verde Motel",
		"Tewa Lodge",
		"Hiland Theater",
		"Zia Motor Lodge",
		"De Anza Motel",
		"Premiere Motel",
		"Nob Hill Court",
		"Nob Hill Business Center",
		"Hiway House Motel",
		"Route 66 Diner",
		"El Camino Motel",
		"Kimo Theater",
		"Firestone",
		"The Dog House Drive-In",
		"Garcia's Cafe",
		"El Don Motel",
		"Monterey Motel",
		"21 Motel",
		"El Vado Motel",
		"Rainbow Apartments",
		"Americana Motel",
		"La Hacienda Motel",
		"Adobe Manor Motel",
		"Westward Ho Motel",
		"Cafe 66 New Mexican Restaurant",
		"French Quarter Motel",
		"Grandview Motel"

	];
}

export function matchStocks(state, value) {
	return (
		state.name.toLowerCase().indexOf(value.toLowerCase()) !== -1 ||
		state.abbr.toLowerCase().indexOf(value.toLowerCase()) !== -1
	);
}