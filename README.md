# ArkHost Hetzner VPS Module

WHMCS server module for Hetzner Cloud VPS management.

## Features

**Core**

- VPS lifecycle: create, suspend, unsuspend, terminate
- Server control: start, stop, restart, shutdown
- Automatic provisioning on payment

**Advanced**

- Cloud-init support for automated server configuration
- Floating IP management with reverse DNS
- Backup creation and restoration
- Firewall rule management
- Performance graphs (CPU, network, disk I/O)
- Rescue mode with temporary passwords
- ISO mounting
- OS reinstallation

**Interface**

- Bootstrap 4 responsive design
- Multiple language translations included
- Real-time status updates
- VNC console access

## Requirements

- WHMCS 8.9+
- PHP 7.4+
- Hetzner Cloud API token
- cURL extension
- HTTPS connection

## Installation

1. Upload files to `/path/to/whmcs/modules/servers/ArkHostHetznerVPS/`
2. Create server and add it to a server group:
    - Setup → Products/Services → Servers → Create New Group
    - Name: `Hetzner Cloud`
    - Type: `ArkHostHetznerVPS`
    - Hostname: `localhost`
    - Username: Hetzner Project ID (optional)
    - Password: Hetzner Cloud API Token
3. Create products:
    - Setup → Products/Services → Products/Services → Create New Product
    - Type: `VPS/Dedicated Server`
    - Module: `ArkHostHetznerVPS`
    - Server Group: Select Hetzner Cloud

## Configuration

**Module Settings**

- Server Type: `cx23`, `cx33`, `cx43`, `cx53` (Cost-Optimized), `cpx11`, `cpx21`, `cax11`, `ccx13`, etc.
- Operating System: `ubuntu-22.04`, `debian-11`, `rocky-9`, etc.
- Datacenter: `fsn1`, `nbg1`, `hel1`, `ash`, `hil`, `sin`
- Backups: On/Off
- Create Floating IP: On/Off
- Cloud-Init YAML: Optional custom cloud-init configuration

**Custom Field (Required)**

- Field Name: `ArkHostHetznerVPS|VPS ID`
- Type: Text Box
- Admin Only: Yes

For ModulesGarden migration, keep existing `serverID|Server ID` field.

## Configurable Options

Create in Setup → Products/Services → Configurable Options:

**1\. Floating IP Add-on**

- Option Name: `Floating IP`
- Option Type: `Yes/No`
- Options:
    - `No|None`
    - `Yes|1 Floating IP`

**2\. Datacenter Selection**

- Option Name: `datacenter`
- Option Type: `Dropdown`
- Options:
    - `fsn1-dc14|Falkenstein, Germany`
    - `nbg1-dc3|Nuremberg, Germany`
    - `hel1-dc2|Helsinki, Finland`
    - `ash-dc1|Ashburn, USA`
    - `hil-dc1|Hillsboro, USA`
    - `sin-dc1|Singapore, Singapore`

**3\. Server Type**

- Option Name: `planid`
- Option Type: `Dropdown`
- Options:
- `cx23|CX23 - 2 vCPU, 4 GB RAM, 40 GB Disk, shared (Cost-Optimized)`
- `cx33|CX33 - 4 vCPU, 8 GB RAM, 80 GB Disk, shared (Cost-Optimized)`
- `cx43|CX43 - 8 vCPU, 16 GB RAM, 160 GB Disk, shared (Cost-Optimized)`
- `cx53|CX53 - 16 vCPU, 32 GB RAM, 320 GB Disk, shared (Cost-Optimized)`
- `cpx11|CPX 11 - 2 vCPU, 2 GB RAM, 40 GB Disk, shared`
- `cpx21|CPX 21 - 3 vCPU, 4 GB RAM, 80 GB Disk, shared`
- `cpx31|CPX 31 - 4 vCPU, 8 GB RAM, 160 GB Disk, shared`
- `cpx41|CPX 41 - 8 vCPU, 16 GB RAM, 240 GB Disk, shared`
- `cpx51|CPX 51 - 16 vCPU, 32 GB RAM, 360 GB Disk, shared`
- `cax11|CAX11 - 2 vCPU, 4 GB RAM, 40 GB Disk, shared`
- `cax21|CAX21 - 4 vCPU, 8 GB RAM, 80 GB Disk, shared`
- `cax31|CAX31 - 8 vCPU, 16 GB RAM, 160 GB Disk, shared`
- `cax41|CAX41 - 16 vCPU, 32 GB RAM, 320 GB Disk, shared`
- `ccx13|CCX13 Dedicated CPU - 2 vCPU, 8 GB RAM, 80 GB Disk, dedicated`
- `ccx23|CCX23 Dedicated CPU - 4 vCPU, 16 GB RAM, 160 GB Disk, dedicated`
- `ccx33|CCX33 Dedicated CPU - 8 vCPU, 32 GB RAM, 240 GB Disk, dedicated`
- `ccx43|CCX43 Dedicated CPU - 16 vCPU, 64 GB RAM, 360 GB Disk, dedicated`
- `ccx53|CCX53 Dedicated CPU - 32 vCPU, 128 GB RAM, 600 GB Disk, dedicated`
- `ccx63|CCX63 Dedicated CPU - 48 vCPU, 192 GB RAM, 960 GB Disk, dedicated`
- `cx22|CX22 - 2 vCPU, 4 GB RAM, 40 GB Disk, shared`
- `cx32|CX32 - 4 vCPU, 8 GB RAM, 80 GB Disk, shared`
- `cx42|CX42 - 8 vCPU, 16 GB RAM, 160 GB Disk, shared`
- `cx52|CX52 - 16 vCPU, 32 GB RAM, 320 GB Disk, shared`


**4\. Operating System**

- Option Name: `osid`
- Option Type: `Dropdown`
- Options:
- `debian-11|Debian 11`
- `debian-12|Debian 12`
- `debian-13|Debian 13`
- `ubuntu-22.04|Ubuntu 22.04`
- `ubuntu-24.04|Ubuntu 24.04`
- `rocky-8|Rocky Linux 8`
- `rocky-9|Rocky Linux 9`
- `rocky-10|Rocky Linux 10`
- `alma-8|AlmaLinux 8`
- `alma-9|AlmaLinux 9`
- `alma-10|AlmaLinux 10`
- `centos-stream-9|CentOS Stream 9`
- `centos-stream-10|CentOS Stream 10`
- `opensuse-15|openSUSE 15`
- `fedora-41|Fedora 41`
- `fedora-42|Fedora 42`
- `docker-ce|Docker CE`
- `lamp|LAMP Stack`
- `wordpress|WordPress`
- `nextcloud|Nextcloud`
- `gitlab|GitLab`
- `jitsi|Jitsi`
- `wireguard|WireGuard`
- `prometheus-grafana|Prometheus + Grafana`
- `owncast|Owncast`
- `photoprism|PhotoPrism`
- `rustdesk|RustDesk`


  

## Client Interface

**Overview**: Server status, information, control buttons **Graphs**: CPU, network, disk I/O monitoring **Backups**: Create, restore, delete backups **Settings**: Hostname, ISO, password reset, reinstall, firewall, rescue mode, floating IP

## SSH Key Management

**Why no SSH key feature?**

Hetzner's API stores SSH keys at the project level, not per-server. In a multi-tenant WHMCS environment, this creates security risks:

- Potential key exposure across customers
- No proper isolation between services
- Complex workarounds that compromise security

**Current recommended approach:**

1. Use password authentication for initial access
2. Add your SSH key manually: `ssh-copy-id root@your-server-ip`
3. Secure your server:

```bash
sed -i 's/PasswordAuthentication yes/PasswordAuthentication no/' /etc/ssh/sshd_configsystemctl restart sshd
```

This ensures proper key isolation and security for each customer.

**Future development:**

We're exploring secure implementations using cloud-init or per-server user data to enable SSH key management while maintaining proper isolation.

## Cloud-Init Support

Cloud-init allows automatic server configuration during first boot. Unlike project-level SSH keys, cloud-init user_data is per-server, ensuring proper isolation in multi-tenant environments.

**Configuration:**

1. Navigate to Setup → Products/Services → Products/Services
2. Edit your product → Module Settings tab
3. Find "Cloud-Init YAML (Optional)" textarea
4. Enter your cloud-init configuration in YAML format
5. Leave empty to skip cloud-init

**Common Use Cases:**

**1. Change APT Mirrors** (original use case - avoid Hetzner mirrors):
```yaml
#cloud-config
apt:
  primary:
    - arches: [default]
      uri: http://de.archive.ubuntu.com/ubuntu/
```

**2. Add SSH Keys** (secure alternative to project-level keys):
```yaml
#cloud-config
users:
  - name: admin
    ssh_authorized_keys:
      - ssh-rsa AAAAB3NzaC1yc2E... user@laptop
    sudo: ALL=(ALL) NOPASSWD:ALL
    shell: /bin/bash
```

**3. Install Docker:**
```yaml
#cloud-config
packages:
  - docker.io
  - docker-compose

runcmd:
  - systemctl enable docker
  - systemctl start docker
```

**4. Security Hardening:**
```yaml
#cloud-config
packages:
  - fail2ban
  - ufw

runcmd:
  - ufw default deny incoming
  - ufw default allow outgoing
  - ufw allow 22/tcp
  - ufw --force enable
  - systemctl enable fail2ban
  - systemctl start fail2ban
```

**5. Combined Configuration:**
```yaml
#cloud-config
apt:
  primary:
    - arches: [default]
      uri: http://mirror.example.com/ubuntu/

users:
  - name: admin
    ssh_authorized_keys:
      - ssh-rsa AAAAB3... admin@company
    sudo: ALL=(ALL) NOPASSWD:ALL

packages:
  - fail2ban
  - ufw
  - docker.io

runcmd:
  - ufw allow 22/tcp
  - ufw --force enable
  - systemctl enable docker fail2ban
```

**Important Notes:**

- YAML must be valid syntax (use a YAML validator if unsure)
- If you don't start with `#cloud-config`, the module will add it automatically
- Cloud-init runs ONCE on first boot only
- Invalid YAML will cause provisioning to fail silently
- Maximum size: 32 KiB (Hetzner API limit)
- Documentation: https://docs.hetzner.cloud/#servers-create-a-server

## Screenshots
![Screenshot 1](screenshots/1.png)
![Screenshot 2](screenshots/2.png)
![Screenshot 3](screenshots/3.png)
![Screenshot 4](screenshots/4.png)
![Screenshot 5](screenshots/5.png)
![Screenshot 6](screenshots/6.png)
![Screenshot 7](screenshots/7.png)
![Screenshot 8](screenshots/8.png)
![Screenshot 9](screenshots/9.png)
![Screenshot 10](screenshots/10.png)

## Troubleshooting

**API Connection Failed**: Check API token in server group settings **Server Not Found**: Verify VPS ID custom field exists **Floating IP Issues**: Enable in configurable options

Enable module debugging: Configuration → System Logs → Module Log

## Support Policy

This is free, open-source software provided AS-IS.

**NO SUPPORT** is provided except through paid channels:
- Premium Support: €100/hour (2 hour minimum)
- Email: support@arkhost.com (paid support only)

### Before Requesting Support
- English only
- Must provide complete error logs
- Must provide steps to reproduce
- Vague reports like "doesn't work" will be ignored

### GitHub Issues
- For documented bugs only
- Requires complete technical information
- Issues lacking proper information will be closed immediately
- This is not a support forum

If you need help with basic installation or configuration, purchase premium support.

## License

MIT License - see [LICENSE](LICENSE) file for details.

Free and open source. Commercial support available.

## Other ArkHost Modules

Check out our other WHMCS modules at [arkhost.com/whmcs-modules.php](https://arkhost.com/whmcs-modules.php "https://arkhost.com/whmcs-modules.php")

© 2025 ArkHost
