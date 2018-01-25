#!/bin/bash

function arret
{
  echo
  echo "Avancement: 99% ---------------------------------------------------------------------------------------------------> ;-) "
  echo

  echo "Fin installation des dépendances"

  echo
  echo "Avancement: 100% ---------------------------------------------------------------------------------------------------> FIN"
  echo

  echo 100 > /tmp/Abeille_dep
  rm /tmp/Abeille_dep

}

function arretSiErreur
{
  echo
  echo "***************"
  echo $1
  echo "***************"
  echo

  arret
  exit 1
}

echo "Début d'installation des dépendances"

touch /tmp/Abeille_dep

echo 0 > /tmp/Abeille_dep
echo
echo "Avancement: 0% ---------------------------------------------------------------------------------------------------> Environnement "
echo

cmd=`id`
echo "id: "$cmd

cmd=`pwd`
echo "pwd: "$cmd

cmd=`uname -a`
echo "uname -a: "$cmd

if [ -d "/etc/php5/fpm/" ]; then
  echo "system tourne avec fpm et php5"
  SERVICE="php5-fpm"
elif [ -d "/etc/php5/apache2/" ]; then
  echo "system tourne avec apache2 et php5"
  SERVICE="apache2"
elif [ -d "/etc/php/7.0/fpm/" ]; then
  echo "system tourne avec fpm et php7"
  SERVICE="php7-fpm"
elif [ -d "/etc/php/7.0/apache2" ]; then
  echo "system tourne avec apache2 et php7"
  SERVICE="apache2"
else
  arretSiErreur "Erreur critique, je ne reconnais pas le system (apache, php,...)"
fi

echo
echo "Avancement: 5% ---------------------------------------------------------------------------------------------------> Install lsb-release php-pear"
echo

apt-get -y install lsb-release php-pear

echo
echo "Avancement: 8% ---------------------------------------------------------------------------------------------------> Ajout repo mosquitto"
echo

archi=`lscpu | grep Architecture | awk '{ print $2 }'`
echo "Architecture: "$archi

if [ "$archi" == "x86_64" ]; then

  if [ `lsb_release -i -s` == "Debian" ]; then

    echo "Release trouvée: Debian"
    if [ -f mosquitto-repo.gpg.key ]; then
      echo "Efface ancien mosquitto-repo.gpg.key"
      rm mosquitto-repo.gpg.key
    fi

    wget http://repo.mosquitto.org/debian/mosquitto-repo.gpg.key
    apt-key add mosquitto-repo.gpg.key

    echo "Release trouvée: Debian"
    if [ -f mosquitto-repo.gpg.key ]; then
      echo "Efface ancien mosquitto-repo.gpg.key"
      rm mosquitto-repo.gpg.key
    fi

    if [ `lsb_release -c -s` == "jessie" ]; then
      echo "Version trouvée: jessie"

      if [ -f /etc/apt/sources.list.d/mosquitto-jessie.list ]; then
        echo "Efface ancien /etc/apt/sources.list.d/mosquitto-jessie.list"
        rm /etc/apt/sources.list.d/mosquitto-jessie.list
      fi

      wget http://repo.mosquitto.org/debian/mosquitto-jessie.list -O /etc/apt/sources.list.d/mosquitto-jessie.list

    elif [ `lsb_release -c -s` == "stretch" ]; then

      if [ -f /etc/apt/sources.list.d/mosquitto-jessie.list ]; then
        echo "Efface ancien /etc/apt/sources.list.d/mosquitto-jessie.list"
        rm /etc/apt/sources.list.d/mosquitto-stretch.list
      fi

      wget http://repo.mosquitto.org/debian/mosquitto-stretch.list -O /etc/apt/sources.list.d/mosquitto-stretch.list

    else
        echo "Erreur critique: je ne connais pas cette version."
        arretSiErreur "Erreur critique: je ne connais pas cette version."
    fi

  else
    echo "Erreur critique: je ne connais pas cette distribution."
    arretSiErreur "Erreur critique: je ne connais pas cette distribution."
  fi

else
  echo "Erreur critique: Je ne connais pas ce type de HW."
  arretSiErreur "Erreur critique: Je ne connais pas ce type de HW."
fi

echo 10 > /tmp/Abeille_dep
echo
echo "Avancement: 10% ---------------------------------------------------------------------------------------------------> Update list package"
echo

apt-get update

echo 30 > /tmp/Abeille_dep
echo
echo "Avancement: 30% ---------------------------------------------------------------------------------------------------> install mosquiito packages"
echo

apt-get -y install mosquitto mosquitto-clients libmosquitto-dev


if [[ -d "/etc/php5/" ]]; then
  echo 70 > /tmp/Abeille_dep
  echo
  echo "Avancement: 70% ---------------------------------------------------------------------------------------------------> php5 deja present on installe php-dev et les librairies mosquitto"
  echo

  apt-get -y install php5-dev

  if [[ -d "/etc/php5/cli/" && ! `cat /etc/php5/cli/php.ini | grep "mosquitto"` ]]; then
    echo "" | pecl install Mosquitto-alpha
    echo "extension=mosquitto.so" | tee -a /etc/php5/cli/php.ini

  elif [[ -d "/etc/php5/fpm/" && ! `cat /etc/php5/fpm/php.ini | grep "mosquitto"` ]]; then
    echo "extension=mosquitto.so" | tee -a /etc/php5/fpm/php.ini

  elif [[ -d "/etc/php5/apache2/" && ! `cat /etc/php5/apache2/php.ini | grep "mosquitto"` ]]; then
    echo "extension=mosquitto.so" | tee -a /etc/php5/apache2/php.ini

  else
    echo "Je ne fais rien, tout semble deja installe pour cette etape"
  fi

else
  echo 70 > /tmp/Abeille_dep
  echo
  echo "Avancement: 70% ---------------------------------------------------------------------------------------------------> php5 pas present on installe php7-dev et les librairies mosquitto"
  echo

  apt-get -y install php7.0-dev

  if [[ -d "/etc/php/7.0/cli/" && ! `cat /etc/php/7.0/cli/php.ini | grep "mosquitto"` ]]; then
    echo "" | pecl install Mosquitto-alpha
    echo "extension=mosquitto.so" | tee -a /etc/php/7.0/cli/php.ini

  elif [[ -d "/etc/php/7.0/fpm/" && ! `cat /etc/php/7.0/fpm/php.ini | grep "mosquitto"` ]]; then
    echo "extension=mosquitto.so" | tee -a /etc/php/7.0/fpm/php.ini
    echo "Le code est bizaare ici car on utilise php7 et fait reference a fpm-php5, probablement une erreur mais je n ai pas de system pour verifier"

  elif [[ -d "/etc/php/7.0/apache2/" && ! `cat /etc/php/7.0/apache2/php.ini | grep "mosquitto"` ]]; then
    echo "extension=mosquitto.so" | tee -a /etc/php/7.0/apache2/php.ini

  else
    echo "Je ne fais rien, tout semble deja installe pour cette etape"
  fi
fi

echo 90 > /tmp/Abeille_dep
echo
echo "Avancement: 90% ---------------------------------------------------------------------------------------------------> Demmarrage des services."
echo

# Docker detection, may be useful to add RPI detection here.
if [[ $(grep -c docker /proc/1/cgroup) -gt 0 ]]; then
  echo "I'm running on docker".
  /etc/init.d/mosquitto start

  if [[ "apache2" == ${SERVICE} ]]; then
    apache2ctl restart
  else
    /etc/init.d/${SERVICE} restart
  fi
# Pour tous les autres systemes/
else
  /etc/init.d/mosquitto start &
  /etc/init.d/${SERVICE} restart &
fi

echo
echo "Avancement: 99% ---------------------------------------------------------------------------------------------------> ;-) "
echo

echo "Fin installation des dépendances"

echo
echo "Avancement: 100% ---------------------------------------------------------------------------------------------------> FIN"
echo

echo 100 > /tmp/Abeille_dep

rm /tmp/Abeille_dep
