# Lab 2: Cyber Incident Impact Mapping

## Fictional Breach Scenario

At Riverside University, a registrar staff member clicked a phishing link and entered their credentials on a fake login page. The attacker logged in to the staff email account, created a hidden mail-forwarding rule, used single sign-on to open the student information system (SIS), and exported a list of student names, IDs, and email addresses. The attacker then sent phishing emails from the staff account to other employees. The activity was noticed two days later when colleagues reported strange emails.

## Impact Map

| Category | Immediate consequences | Secondary consequences |
| --- | --- | --- |
| Confidentiality | Student personal data exported; staff mailbox contents read | Identity theft and targeted phishing against students |
| Integrity | Attacker-created forwarding rule; possible altered records | Doubt about accuracy of student records; audit required |
| Availability | Compromised account locked, staff loses email access | Registrar operations slowed while systems are investigated |
| Financial | Incident response and forensic costs | Legal fees, possible fines, credit monitoring for students |
| Legal / regulatory | Data-protection notification duties triggered | Investigations, potential penalties |
| Reputation | Students and parents lose trust | Lower enrollment, negative press, staff morale drops |

## Affected Users
- The registrar staff member whose account was taken over
- All students whose data was exported
- Other employees who received phishing emails
- Parents/guardians and partners who have contact with the registrar
- IT/security staff, management, and legal/compliance teams

## Business Functions Affected
- Student registration and enrollment
- Records and transcript services
- Internal and external email communication
- Student support and admissions
- Compliance and reporting

## Three Containment Actions
1. **Disable the compromised account and revoke all sessions/tokens**, then reset the password and require MFA.
2. **Remove the attacker's forwarding rule and block the phishing domain/sender** at the email gateway; warn staff not to open the malicious emails.
3. **Restrict access to the SIS** (temporarily limit exports, review SSO logs) and isolate the staff workstation for scanning.

## Short Incident Summary
A registrar employee's credentials were phished, allowing an attacker to access email and export student data from the SIS. The attacker then used the account for internal phishing. The incident was detected after two days via user reports. The account was disabled, the forwarding rule removed, the phishing domain blocked, and SIS access restricted. Affected students will be notified and monitoring increased. Root causes: no MFA and limited monitoring of unusual exports.

## Student Questions

**What information is sensitive?**  
Student names, IDs, contact details, grades and financial records, staff credentials, and the contents of staff email.

**What service should be restored first?**  
Secure staff email/authentication first (with MFA), then the SIS for registration, since registration is the core business function and has time pressure.

**What evidence should be preserved?**  
Email and SIS access logs, the phishing email with full headers, the forwarding rule configuration, SSO/login records with IPs and timestamps, and a disk/memory image of the affected workstation. Record who handled it and when (chain of custody).
