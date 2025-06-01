import networkx as nx
import osmnx as ox
import sys
import json

# Membaca graf jalan
G = nx.read_gpickle("indonesia_graph.gpickle")

# Mendapatkan input lat, lon
start_lat, start_lon, end_lat, end_lon = map(float, sys.argv[1:5])

# Menemukan node terdekat untuk koordinat start dan goal
orig = ox.nearest_nodes(G, start_lon, start_lat)
dest = ox.nearest_nodes(G, end_lon, end_lat)

# Mencari rute terpendek menggunakan algoritma shortest path
route = nx.shortest_path(G, orig, dest, weight='length')

# Mengambil koordinat dari node-node yang ada dalam rute
coords = [(G.nodes[n]['y'], G.nodes[n]['x']) for n in route]

# Menampilkan rute dalam format JSON
print(json.dumps({
    "status": True,
    "message": "Route calculated successfully",
    "path": coords
}))
