# Lab 3: CIA Classification and Controls

## Completed CIA Worksheet

| # | Scenario | Affected CIA property | Recommended control | Control type |
| --- | --- | --- | --- | --- |
| 1 | An employee emails a payroll file to the wrong recipient | Confidentiality | Data loss prevention (DLP) and recipient warnings | Preventive |
| 2 | A hacker steals a customer database | Confidentiality | Encryption at rest and access controls | Preventive |
| 3 | A student secretly changes their grade in the system | Integrity | Role-based access plus audit logging of changes | Preventive / Detective |
| 4 | A ransomware attack locks all servers | Availability | Offline backups and a recovery plan | Corrective |
| 5 | A DDoS attack takes down the registration site | Availability | DDoS protection / rate limiting | Preventive |
| 6 | A power failure shuts down the data center | Availability | UPS and backup generator | Preventive |
| 7 | An attacker modifies a bank transfer amount in transit | Integrity | TLS encryption and digital signatures | Preventive |
| 8 | Someone shoulder-surfs a password in a lab | Confidentiality | Screen privacy filters, MFA, user awareness | Preventive |
| 9 | A file is corrupted by a faulty disk | Integrity / Availability | RAID, checksums, backups | Preventive / Corrective |
| 10 | An admin accidentally deletes a database | Availability / Integrity | Backups and change approval | Corrective / Preventive |
| 11 | An unencrypted laptop with student data is stolen | Confidentiality | Full-disk encryption and remote wipe | Preventive / Corrective |
| 12 | Malware silently alters files on a server | Integrity | File integrity monitoring (FIM) and antimalware | Detective / Preventive |
| 13 | Unauthorized user logs into the HR system with a stolen password | Confidentiality | MFA and login anomaly alerts | Preventive / Detective |
| 14 | A misconfigured firewall blocks all users from the LMS | Availability | Change management and testing before rollout | Preventive |
| 15 | A ransomware group steals data, encrypts systems, and demands payment | Confidentiality, Integrity, Availability | Backups, network segmentation, EDR, incident response plan | Preventive / Detective / Corrective |

## Student Questions

**Can one incident affect all three CIA properties?**  
Yes. Ransomware with data theft (scenario 15) breaches confidentiality (data stolen), integrity (files modified/encrypted), and availability (systems unusable) at the same time. Many real incidents touch more than one property.

**Why is backup primarily an availability/recovery control?**  
A backup does not stop an attack or prevent data from being seen. Its purpose is to restore data and services after loss, corruption, or ransomware, so it keeps data available and is a corrective control. (Backups also help integrity by providing a known-good copy, but recovery is the main purpose.)
