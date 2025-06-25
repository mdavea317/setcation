var simplemaps_countrymap_mapdata={
  main_settings: {
    //General settings
		width: "300", //or 'responsive'
    background_color: "#FFFFFF",
    background_transparent: "yes",
    border_color: "#ffffff",
    pop_ups: "detect",
    
		//State defaults
		state_description: "State description",
    state_color: "#88A4BC",
    state_hover_color: "#3B729F",
    state_url: "",
    border_size: 1.5,
    all_states_inactive: "no",
    all_states_zoomable: "yes",
    
		//Location defaults
		location_description: "Location description",
    location_url: "",
    location_color: "#FF0067",
    location_opacity: 0.8,
    location_hover_opacity: 1,
    location_size: 25,
    location_type: "square",
    location_image_source: "frog.png",
    location_border_color: "#FFFFFF",
    location_border: 2,
    location_hover_border: 2.5,
    all_locations_inactive: "no",
    all_locations_hidden: "no",
    
		//Label defaults
		label_color: "#d5ddec",
    label_hover_color: "#d5ddec",
    label_size: 22,
    label_font: "Arial",
    hide_labels: "no",
    hide_eastern_labels: "no",
   
		//Zoom settings
		zoom: "yes",
    manual_zoom: "yes",
    back_image: "no",
    initial_back: "no",
    initial_zoom: "-1",
    initial_zoom_solo: "no",
    region_opacity: 1,
    region_hover_opacity: 0.6,
    zoom_out_incrementally: "yes",
    zoom_percentage: 0.99,
    zoom_time: 0.5,
    
		//Popup settings
		popup_color: "white",
    popup_opacity: 0.9,
    popup_shadow: 1,
    popup_corners: 5,
    popup_font: "12px/1.5 Verdana, Arial, Helvetica, sans-serif",
    popup_nocss: "no",
    
		//Advanced settings
		div: "map",
    auto_load: "yes",
    url_new_tab: "no",
    images_directory: "default",
    fade_time: 0.1,
    link_text: "View Website"
  },
  state_specific: {
    PHL2511: {
      name: "Tawi-Tawi",
      description: "default",
      color: "default",
      hover_color: "default",
      url: "default"
    },
    PHL2513: {
      name: "Bohol"
    },
    PHL2514: {
      name: "Cebu"
    },
    PHL2516: {
      name: "Negros Oriental"
    },
    PHL2517: {
      name: "Siquijor"
    },
    PHL2518: {
      name: "Negros Occidental"
    },
    PHL2519: {
      name: "Basilan"
    },
    PHL2520: {
      name: "Zamboanga del Norte"
    },
    PHL2521: {
      name: "Zamboanga Sibugay"
    },
    PHL2522: {
      name: "Zamboanga del Sur"
    },
    PHL2523: {
      name: "Misamis Occidental"
    },
    PHL2524: {
      name: "Sulu"
    },
    PHL2525: {
      name: "Aklan"
    },
    PHL2526: {
      name: "Antique"
    },
    PHL2528: {
      name: "Capiz"
    },
    PHL2529: {
      name: "Iloilo"
    },
    PHL2530: {
      name: "Guimaras"
    },
    PHL2534: {
      name: "Palawan"
    },
    PHL2535: {
      name: "Romblon"
    },
    PHL2536: {
      name: "Albay"
    },
    PHL2537: {
      name: "Camarines Norte"
    },
    PHL2538: {
      name: "Camarines Sur"
    },
    PHL2539: {
      name: "Catanduanes"
    },
    PHL2540: {
      name: "Masbate"
    },
    PHL2541: {
      name: "Sorsogon"
    },
    PHL2542: {
      name: "Abra"
    },
    PHL2543: {
      name: "Batanes"
    },
    PHL2545: {
      name: "Cagayan"
    },
    PHL2546: {
      name: "Apayao"
    },
    PHL2547: {
      name: "Ilocos Norte"
    },
    PHL2548: {
      name: "Ilocos Sur"
    },
    PHL2549: {
      name: "Aurora"
    },
    PHL2550: {
      name: "Isabela"
    },
    PHL2551: {
      name: "Ifugao"
    },
    PHL2552: {
      name: "Mountain Province"
    },
    PHL2553: {
      name: "Nueva Vizcaya"
    },
    PHL2554: {
      name: "Quirino"
    },
    PHL2555: {
      name: "Bataan"
    },
    PHL2556: {
      name: "Tarlac"
    },
    PHL2557: {
      name: "Nueva Ecija"
    },
    PHL2558: {
      name: "Pampanga"
    },
    PHL2559: {
      name: "Benguet"
    },
    PHL2560: {
      name: "Zambales"
    },
    PHL2561: {
      name: "La Union"
    },
    PHL2562: {
      name: "Pangasinan"
    },
    PHL2563: {
      name: "Cavite"
    },
    PHL2564: {
      name: "Batangas"
    },
    PHL2565: {
      name: "Bulacan"
    },
    PHL2566: {
      name: "Laguna"
    },
    PHL2567: {
      name: "Rizal"
    },
    PHL2569: {
      name: "Marinduque"
    },
    PHL2570: {
      name: "Mindoro Occidental"
    },
    PHL2571: {
      name: "Mindoro Oriental"
    },
    PHL2572: {
      name: "Quezon"
    },
    PHL2573: {
      name: "Lanao del Norte"
    },
    PHL2574: {
      name: "Lanao del Sur"
    },
    PHL2576: {
      name: "Maguindanao"
    },
    PHL2579: {
      name: "Cotabato"
    },
    PHL2580: {
      name: "Sultan Kudarat"
    },
    PHL2581: {
      name: "Biliran"
    },
    PHL2582: {
      name: "Eastern Samar"
    },
    PHL2583: {
      name: "Leyte"
    },
    PHL2584: {
      name: "Samar"
    },
    PHL2585: {
      name: "Southern Leyte"
    },
    PHL2586: {
      name: "Northern Samar"
    },
    PHL2587: {
      name: "Agusan del Norte"
    },
    PHL2588: {
      name: "Agusan del Sur"
    },
    PHL2589: {
      name: "Bukidnon"
    },
    PHL2590: {
      name: "Camiguin"
    },
    PHL2591: {
      name: "Davao del Norte"
    },
    PHL2592: {
      name: "Compostela Valley"
    },
    PHL2593: {
      name: "Surigao del Norte"
    },
    PHL2594: {
      name: "Surigao del Sur"
    },
    PHL2595: {
      name: "Misamis Oriental"
    },
    PHL2596: {
      name: "Davao del Sur"
    },
    PHL2597: {
      name: "Davao Oriental"
    },
    PHL2598: {
      name: "Sarangani"
    },
    PHL2599: {
      name: "South Cotabato"
    },
    PHL4931: {
      name: "Kalinga"
    },
    PHL4932: {
      name: "Zamboanga"
    },
    PHL4933: {
      name: "Isabela"
    },
    PHL5522: {
      name: "Cebu"
    },
    PHL5523: {
      name: "Mandaue"
    },
    PHL5524: {
      name: "Lapu-Lapu"
    },
    PHL5525: {
      name: "Bacolod"
    },
    PHL5526: {
      name: "Iloilo"
    },
    PHL5527: {
      name: "Cotabato"
    },
    PHL5528: {
      name: "Davao"
    },
    PHL5529: {
      name: "General Santos"
    },
    PHL5530: {
      name: "Iligan"
    },
    PHL5531: {
      name: "Cagayan de Oro"
    },
    PHL5532: {
      name: "Butuan"
    },
    PHL5533: {
      name: "Puerto Princesa"
    },
    PHL5534: {
      name: "Ormoc"
    },
    PHL5535: {
      name: "Tacloban"
    },
    PHL5536: {
      name: "Naga"
    },
    PHL5537: {
      name: "Santiago"
    },
    PHL5538: {
      name: "Angeles"
    },
    PHL5539: {
      name: "Baguio"
    },
    PHL5540: {
      name: "Olongapo"
    },
    PHL5541: {
      name: "Dagupan"
    },
    PHL5542: {
      name: "Mandaluyong City"
    },
    PHL5543: {
      name: "Manila"
    },
    PHL5544: {
      name: "Navotas"
    },
    PHL5545: {
      name: "Caloocan"
    },
    PHL5546: {
      name: "Malabon"
    },
    PHL5547: {
      name: "Valenzuela"
    },
    PHL5549: {
      name: "Quezon City"
    },
    PHL5550: {
      name: "Marikina"
    },
    PHL5551: {
      name: "San Juan"
    },
    PHL5552: {
      name: "Pasig"
    },
    PHL5553: {
      name: "Makati"
    },
    PHL5554: {
      name: "Pasay"
    },
    PHL5555: {
      name: "Paranaque"
    },
    PHL5556: {
      name: "Las Pinas"
    },
    PHL5557: {
      name: "Muntinlupa"
    },
    PHL5558: {
      name: "Taguig"
    },
    PHL5559: {
      name: "Pateros"
    },
    PHL5560: {
      name: "Lucena"
    }
  },
  locations: {
    "0": {
      lat: "14.6042",
      lng: "120.9822",
      name: "Manila"
    }
  }
};