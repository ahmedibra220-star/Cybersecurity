# Lab 4: System Inventory

**Lab VM used:** <!-- e.g., Ubuntu 22.04 in VirtualBox / Windows 10 VM -->

> Run the commands on YOUR lab VM and paste the real output/values below.

## 1. Commands to collect the inventory

| Item | Linux | Windows (PowerShell/CMD) |
| --- | --- | --- |
| OS version | `lsb_release -a` or `cat /etc/os-release` | `winver` or `systeminfo \| findstr /B /C:"OS"` |
| CPU | `lscpu` | `wmic cpu get name` |
| RAM | `free -h` | `systeminfo \| findstr "Total Physical"` |
| Storage | `df -h` and `lsblk` | `wmic logicaldisk get caption,size,freespace` |
| Network adapter | `ip addr` | `ipconfig /all` |
| Running applications | `ps aux` or `top` | `tasklist` or Task Manager |
| Active users | `who` and `w` | `query user` |

## 2. System Inventory (fill in from your VM)

| Item | Value |
| --- | --- |
| OS version | |
| CPU | |
| RAM | |
| Storage | |
| Network adapter (name / IP) | |
| Running applications | |
| Active users | |

## 3. Three items that should be protected
1. **User data and files** (documents, credentials) - confidentiality and integrity matter.
2. **The operating system and its configuration** - tampering would compromise the whole system.
3. **The network interface and its exposed services** - the main entry point for remote attackers.

## 4. Hardening Checklist (three recommendations)
- [ ] Keep the OS and applications updated (enable automatic security updates).
- [ ] Remove or disable unused applications and services.
- [ ] Use a standard user account for daily work, strong passwords, and enable the host firewall.

## Student Questions

**Why should unsupported operating systems be avoided?**  
Vendors no longer release security patches for them, so newly discovered vulnerabilities stay open forever and are easy for attackers to exploit.

**Why are unused applications a security concern?**  
Every installed application adds code that can contain vulnerabilities, may run services or open ports, and often goes unpatched. Removing it shrinks the attack surface.
