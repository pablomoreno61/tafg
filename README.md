# TFG Gamification

TFG gamification és el projecte de fi de carrera de Pablo Moreno. El projecte està construït sobre un paquet de desenvolupament de Phalcon.

Requisits:
* Operating System: Windows, Linux, or macOS
* Virtualbox >= 5.1 (if you want to build the VirtualBox box)
* VMware Fusion (or Workstation - if you want to build the VMware box)
* Vagrant >= 1.9

*Pots trobar més informació a https://github.com/phalcon/box

## Instruccions d'instal·lació

1) Instal·lar paquets addicionals de Vagrant

```
vagrant plugin install vagrant-bindfs
vagrant plugin install vagrant-hostsupdater
vagrant plugin install vagrant-vbguest
```

2) Instal·lar màquina virtual

Suposant que el codi està descarregat a dins del workspace, a un directori "tfg":

```
cd ~/workspace/tfg/Vagrant
./install
```

3) Aixecar màquina

```
vagrant up
```

4) Un cop aixecada, podem accedir a ella per ssh:

```
vagrant ssh
```

5) Un cop a dins, generem l’estructura de base de dades:

```
cd /var/www/tfg
vendor/bin/doctrine orm:schema-tool:update --force -vvv --dump-sql --em=dev
```

6) Inicialitzem el setup de l’aplicació

```
cd /var/ww/tfg
php bin/cli.php dev gamification/setup initial
```

7) Creem estructura de directoris necessària

```
cd /var/ww/tfg
mkdir public/uploads/avatars/dev
mkdir public/uploads/crews/dev
mkdir cache/doctrine/hydrator
mkdir cache/doctrine/proxy
mkdir cache/volt
```