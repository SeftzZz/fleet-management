import heapq
import math
import sys
import json

class Node:
    def __init__(self, x, y, g=0, h=0):
        self.x = x
        self.y = y
        self.g = g  # biaya perjalanan dari titik asal
        self.h = h  # perkiraan biaya ke tujuan (heuristik)
        self.f = g + h  # total biaya (g + h)
        self.parent = None

    def __lt__(self, other):
        return self.f < other.f

    def __eq__(self, other):
        return self.x == other.x and self.y == other.y

    def __hash__(self):
        return hash((self.x, self.y))

def heuristic(node, goal):
    # Menggunakan jarak Euclidean sebagai heuristik
    return math.sqrt((node.x - goal.x) ** 2 + (node.y - goal.y) ** 2)

def astar(start, goal, grid):
    open_list = []
    closed_list = set()

    heapq.heappush(open_list, start)
    # print(f"[INFO] Memulai A* dari ({start.x}, {start.y}) ke ({goal.x}, {goal.y})")
    
    while open_list:
        current = heapq.heappop(open_list)
        # print(f"[DEBUG] Memproses node ({current.x}, {current.y}) dengan f={current.f:.2f}, g={current.g}, h={current.h:.2f}")

        if current == goal:
            # print("[INFO] Tujuan ditemukan, membangun jalur...")
            path = []
            while current:
                path.append((current.x, current.y))
                current = current.parent
            # print("[INFO] Jalur berhasil dibangun.")
            return path[::-1]

        closed_list.add(current)

        # Tetangga (atas, bawah, kiri, kanan)
        neighbors = [
            Node(current.x+1, current.y),
            Node(current.x-1, current.y),
            Node(current.x, current.y+1),
            Node(current.x, current.y-1),
        ]
        
        for neighbor in neighbors:
            if neighbor in closed_list:
                # print(f"[SKIP] Tetangga ({neighbor.x}, {neighbor.y}) sudah dalam closed list.")
                continue

            neighbor.g = current.g + 1
            neighbor.h = heuristic(neighbor, goal)
            neighbor.f = neighbor.g + neighbor.h
            neighbor.parent = current
            
            existing = [n for n in open_list if n.x == neighbor.x and n.y == neighbor.y]
            if not existing or neighbor.f < existing[0].f:
                heapq.heappush(open_list, neighbor)
                # print(f"[ADD] Menambahkan tetangga ({neighbor.x}, {neighbor.y}) ke open list dengan f={neighbor.f:.2f}")

    # print("[WARN] Tidak ada jalur yang ditemukan.")
    return None

# Contoh penggunaan:
start_node = Node(0, 0)
goal_node = Node(4, 4)
path = astar(start_node, goal_node, None)
# print("Path:", path)

if __name__ == "__main__":
    x1, y1, x2, y2 = map(int, sys.argv[1:5])
    start_node = Node(x1, y1)
    goal_node = Node(x2, y2)
    path = astar(start_node, goal_node, None)
    
    result = {
        "status": True,
        "message": "Route calculated successfully" if path else "No path found",
        "path": path
    }
    print(json.dumps(result))