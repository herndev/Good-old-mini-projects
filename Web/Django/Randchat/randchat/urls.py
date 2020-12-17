"""randchat URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/3.0/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path, include
from django.conf.urls import url
from chat import views as chatView
from chat import urls as chaturls

urlpatterns = [
    path('admin/', admin.site.urls),
    url(r'^$', chatView.indexView),
    url(r'^chat/', chatView.mainView),
    url(r'^proceed/', chatView.proceedRequest),
    url(r'^reset/', chatView.resetRequest),
    url(r'^send/', chatView.sendRequest),
    url(r'^sample/', chatView.sampleView),
    path('randchat/', include(chaturls)),
]
