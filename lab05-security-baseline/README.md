# Lab 5: Windows/Linux Security Baseline

**System used:** <!-- Windows or Linux VM -->

> Do these steps on your own lab VM, take screenshots, and save them in `screenshots/` (name them `before-*.png` and `after-*.png`).

## Steps and Commands

**1. Create a non-administrator lab account**
- Linux: `sudo adduser labuser` (do NOT add to `sudo` group); verify with `id labuser`
- Windows: Settings > Accounts > Other users > Add account > keep type **Standard user** (or `net user labuser * /add`)

**2. Review running processes**
- Linux: `ps aux --sort=-%cpu | head` or `top`
- Windows: `tasklist` or Task Manager

**3. Review services**
- Linux: `systemctl list-units --type=service --state=running`
- Windows: `services.msc` or `Get-Service | Where-Object {$_.Status -eq "Running"}`

**4. Open security/system logs**
- Linux: `sudo journalctl -p 3 -xb` and `sudo tail -n 50 /var/log/auth.log`
- Windows: Event Viewer > Windows Logs > Security / System

**5. Record five observations** (write your real ones)

| # | Observation |
| --- | --- |
| 1 | |
| 2 | |
| 3 | |
| 4 | |
| 5 | |

Example ideas: number of running services, a service you do not recognize, failed login entries, your account's privilege level, how many processes run as root/SYSTEM.

**6. Two safe hardening changes** (pick two, take before/after screenshots)
- Disable an unneeded service (Linux: `sudo systemctl disable --now cups`; Windows: set an unneeded service to Disabled)
- Enable the firewall (Linux: `sudo ufw enable`; Windows: turn on Windows Defender Firewall)
- Apply pending updates (Linux: `sudo apt update && sudo apt upgrade`; Windows: Windows Update)
- Enforce a password/lockout policy

| Change | Before | After |
| --- | --- | --- |
| 1 | screenshots/before-1.png | screenshots/after-1.png |
| 2 | screenshots/before-2.png | screenshots/after-2.png |

## Student Questions

**What is the difference between a user and a process?**  
A user is an identity (account) with permissions. A process is a running program. Every process runs with the privileges of some user, so a process started by an admin can do far more damage if compromised.

**Why should normal users avoid administrator/root privileges?**  
Least privilege: if malware or a mistake runs under an admin account, it can change the whole system. A standard account limits the damage to that user's files and settings.
