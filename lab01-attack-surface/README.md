# Lab 1: Personal and Organizational Attack Surface

**Objective:** Inventory assets of a fictional university, classify them, identify threats, rank risk, and recommend controls.

**Fictional organization:** Riverside University

## Asset / Threat / Control Table

| # | Asset | Type | Threat | Risk | Control (top-5 risks only) | Control type |
| --- | --- | --- | --- | --- | --- | --- |
| 1 | Student records database | Data | Unauthorized access / data leak (e.g., SQL injection) | **High** | Encrypt data at rest, role-based access, database activity monitoring | Preventive + Detective |
| 2 | Payroll application | Software | Ransomware or payroll fraud | **High** | Offline/immutable backups and MFA for finance users | Corrective + Preventive |
| 3 | University email service | Service | Phishing leading to account takeover | **High** | MFA and email filtering | Preventive |
| 4 | Course registration portal | Service | DDoS during registration week | **High** | DDoS protection, rate limiting, load balancing | Preventive |
| 5 | IT administrator accounts | Identity | Credential theft / password reuse | **High** | Privileged access management, MFA, alerts on admin logins | Preventive + Detective |
| 6 | Campus core router/firewall | Hardware | Unpatched firmware or misconfiguration | Medium | - | - |
| 7 | Computer lab PCs | Hardware | Malware via USB or unsafe downloads | Medium | - | - |
| 8 | Learning management system | Service | Credential stuffing | Medium | - | - |
| 9 | Campus Wi-Fi | Service | Rogue access point / evil twin | Medium | - | - |
| 10 | Research data storage | Data | Accidental deletion or insider misuse | Medium | - | - |
| 11 | Faculty laptops | Hardware | Theft or loss | Medium | - | - |
| 12 | Library website | Software | Defacement | Low | - | - |

## Student Questions

**Which asset is most critical?**  
The student records database. It holds personal and academic data for every student, is protected by privacy expectations, and would be very hard to recreate if lost or corrupted. Most other services depend on it.

**Which risk has the greatest impact?**  
Compromise of IT administrator accounts (asset 5). An attacker with admin rights can reach almost every other asset: read or delete databases, disable logging, and deploy ransomware. Its impact spans confidentiality, integrity, and availability at once.

**Which control is preventive and which is detective?**  
- **Preventive:** MFA and email filtering (stop the attack from succeeding), encryption, role-based access.
- **Detective:** Database activity monitoring and alerts on admin logins (they do not stop the attack, but reveal it).
- **Corrective:** Offline backups (restore after damage).
