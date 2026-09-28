# Lab 9: Observe Network Protocols

> Capture only your own traffic on your own lab machine. Save annotated screenshots in `screenshots/`.

## Steps

**1. nslookup on an approved domain**
```
nslookup example.com
```

**2. Start a Wireshark capture**
- Select your active interface (Wi-Fi/Ethernet/eth0) and click Start.
- Open the approved website in a browser (e.g., https://example.com), then stop the capture.

**3. Identify DNS and TCP/TLS traffic using display filters**

| Filter | What you should see |
| --- | --- |
| `dns` | DNS query from your machine and the response with the IP address |
| `tcp.flags.syn==1` | TCP handshake beginning (SYN, then SYN/ACK, then ACK) |
| `tls.handshake` | TLS Client Hello / Server Hello and certificate exchange |
| `tcp.port==443` | All HTTPS traffic |

**4. Record destination IPs and protocols (fill from your capture)**

| Packet | Protocol | Source | Destination | Info |
| --- | --- | --- | --- | --- |
| | DNS | your IP | DNS server IP | Standard query A example.com |
| | DNS | DNS server | your IP | Response with IP |
| | TCP | your IP | web server IP:443 | SYN / SYN-ACK / ACK |
| | TLSv1.3 | your IP | web server IP | Client Hello |
| | TLSv1.3 | web server | your IP | Server Hello / Application Data |

**5. Annotated screenshots** - circle the DNS query, the response, the TCP handshake, and the TLS handshake. Files: `screenshots/dns.png`, `screenshots/tls.png`.

## Why HTTPS payloads are not readable
After the TLS handshake, the client and server agree on session keys, and all HTTP data is sent as encrypted "Application Data". Wireshark shows only ciphertext because only the two endpoints have the keys. Only metadata (IP addresses, ports, sizes, and often the server name in the handshake) stays visible.

## Student Questions

**What would happen if DNS were unavailable?**  
Names could not be resolved to IP addresses, so websites and services would appear unreachable when accessed by name, even though the network works. Access by IP address would still succeed.

**What security benefit does TLS provide?**  
Confidentiality (eavesdroppers cannot read the data), integrity (tampering is detected), and authentication of the server through its certificate.
