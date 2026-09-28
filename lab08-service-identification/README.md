# Lab 8: Service Identification in an Isolated VM

> Use only instructor-approved services in your isolated VM. Commands below assume Ubuntu/Debian; use `netstat -ano` on Windows.

## Steps

**1. Start instructor-approved services (example: SSH and Apache)**
```
sudo systemctl start ssh
sudo systemctl start apache2
```

**2. Identify listening ports with local tools**
```
sudo ss -tulpn
```
(`-t` TCP, `-u` UDP, `-l` listening, `-p` process, `-n` numeric)

**3. Match each port to a service (fill from your output)**

| Port | Protocol | Process | Service | Notes |
| --- | --- | --- | --- | --- |
| 22 | TCP | sshd | SSH (remote login) | Encrypted remote administration |
| 80 | TCP | apache2 | HTTP (web server) | Unencrypted web traffic |
| 53 | UDP/TCP | systemd-resolved | DNS resolver | Local only (127.0.0.53) |
| | | | | |

**4. Disable one unnecessary service (example: Apache)**
```
sudo systemctl stop apache2
sudo systemctl disable apache2
```

**5. Verify the port is no longer listening**
```
sudo ss -tulpn | grep :80
```
No output means port 80 is closed. Save before/after screenshots in `screenshots/`.

## Hardening Note
Apache was not needed for this VM, so it was stopped and disabled so it will not start on boot. Port 80 no longer listens, which removes a service that could be attacked. SSH stays because it is required for administration; it should use strong authentication and only be reachable from trusted hosts.

## Student Questions

**Why should unused services be disabled?**  
Each running service is code that may contain vulnerabilities and listens for connections. Disabling unused services reduces the attack surface and the number of things that must be patched and monitored.

**What is the difference between a port and a protocol?**  
A protocol is a set of rules for communication (HTTP, SSH, DNS). A port is a number identifying a specific service endpoint on a host. Protocols usually have default ports (HTTP 80, HTTPS 443, SSH 22), but a protocol can run on a different port.
