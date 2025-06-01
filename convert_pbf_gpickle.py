import osmnx as ox
import networkx as nx

# Mengonversi .osm.pbf menjadi graf jalan
# Pastikan file indonesia-latest.osm.pbf berada di direktori yang benar
input_pbf = "indonesia-latest.osm"

# Mengonversi file OSM ke dalam graf jalan
G = ox.graph_from_xml(input_pbf)

# Simpan graf untuk digunakan nanti
nx.write_gpickle(G, "indonesia_graph.gpickle")
