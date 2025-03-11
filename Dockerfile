FROM centos:centos7

RUN mkdir /etc/yum.repos.d/old
RUN mv /etc/yum.repos.d/CentOS*.repo /etc/yum.repos.d/old/

COPY ./CentOS.repo /etc/yum.repos.d/
COPY ./epel.repo /etc/yum.repos.d/

RUN yum makecache
RUN yum install traceroute mtr nano net-tools iproute2 iputils-ping bind-utils telnet -y
RUN rpm --import https://dl.fedoraproject.org/pub/epel/RPM-GPG-KEY-EPEL-7
RUN rpm -q gpg-pubkey --qf "%{version}-%{release}  %{summary}\n"
RUN yum install http://rpms.remirepo.net/enterprise/remi-release-7.rpm -y
RUN yum install yum-utils -y
RUN yum-config-manager --disable 'remi-php*'
RUN yum-config-manager --enable remi-php56
RUN yum install httpd php php-cli php-common -y

WORKDIR /var/www/html

RUN rm -rf /var/www/html/index.php
RUN rm -rf /var/www/html/index.html

COPY . .

RUN sh LookingGlass/configure.sh -y

EXPOSE 80 443

CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]
