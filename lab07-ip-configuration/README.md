# Lab 7: IP Configuration and Connectivity

> Run these on your lab VM and paste your real results. Save screenshots in `screenshots/`.

## Step 1: Show IP configuration
- Windows: `ipconfig /all`
- Linux: `ip addr` and `ip route` (default gateway), `resolvectl status` or `cat /etc/resolv.conf` (DNS)

## Network Information Worksheet

| Item | Value (from your VM) | Explanation |
| --- | --- | --- |
| IPv4 address | | Unique address of this host on the network; private ranges are 10.x, 172.16-31.x, 192.168.x |
| Subnet mask / CIDR | | Defines which addresses are in the same local network (e.g., /24 = 255.255.255.0) |
| Default gateway | | Router that forwards traffic leaving the local network |
| DNS server | | Server that translates names into IP addresses |

## Step 2: Ping the gateway
```
ping <gateway-ip>          # Windows: 4 replies by default
ping -c 4 <gateway-ip>     # Linux
```
Record: replies received, packet loss %, average time.

**Explanation:** Replies mean the host can reach its gateway at Layer 3, so the local network path works. Time under a few ms is normal on a LAN. If it fails, check the IP settings, cable/virtual adapter, or a firewall blocking ICMP.

## Step 3: nslookup on a permitted domain
```
nslookup example.com
```
Record: the DNS server that answered and the IP address(es) returned.

**Explanation:** The first lines show which DNS server was used. The answer section shows the IP address(es) for the name. "Non-authoritative answer" means the reply came from a cache rather than the domain's own DNS server. If it fails, DNS is misconfigured or unreachable.

## Student Questions

**What is the purpose of a default gateway?**  
It is the router a host sends traffic to when the destination is outside its own subnet. Without it, the host can only talk to devices on the local network.

**What does DNS do?**  
DNS resolves human-friendly names (example.com) to IP addresses so computers can connect. Without DNS you could still reach sites by IP, but names would not work.
